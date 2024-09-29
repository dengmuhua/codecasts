<?php

namespace App\Services;

use App\Models\User;
use App\Notifications\EmailValidateCodeNotification;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Notification;

class CodeServices
{
    /**
     * 统一发送接口
     * @param string|int $account
     * @return mixed
     */
    public function send(string|int $account): mixed
    {
        $action = filter_var($account, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
        if ($cache = Cache::get($account)){
            $diff = $cache['sendTime']->diffInSeconds(now());
            $timeout = config('system.code.timeout');
            if ($diff <= $timeout){
                $time = $timeout - $diff;
                abort(403, "请勿频繁发送验证码，请{$time}秒后再操作");
            }
        }
        return $this->$action($account);
    }

    /**
     * 发送邮件验证码
     * @param string $email
     * @return int
     */
    public function email(string $email): int
    {
        $user = User::factory()->make(['email' => $email]);
        Notification::send($user, new EmailValidateCodeNotification($code = $this->getCode()));
        $this->cache($email, $code);
        return $code;
    }

    /**
     * 校验验证码
     * @param string $account
     * @param string $code
     * @return bool
     */
    public function check(string $account, string $code): bool
    {
        return (Cache::get($account)['code'] ?? '') == $code;
    }

    /**
     * 清除验证码缓存
     * @param string $account
     * @return void
     */
    public function clear(string $account): void
    {
        Cache::forget($account);
    }

    /**
     * 缓存验证码
     * @param string $account
     * @param string $code
     * @return void
     */
    protected function cache(string $account, string $code): void
    {
        Cache::put($account, ['code' => $code,'sendTime' => now()], 600);
    }

    /**
     * 获取验证码
     * @return int
     */
    protected function getCode(): int
    {
        return rand(pow(10, config('system.code.length') - 1), pow(10, config('system.code.length')) - 1);
    }
}
