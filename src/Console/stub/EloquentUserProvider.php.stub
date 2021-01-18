<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Auth\EloquentUserProvider as UserProvider;
use Illuminate\Support\Str;

/**
 * 重写用户（Auth）相关逻辑
 *
 * Class EloquentUserProvider
 * @package App\Providers
 */
class EloquentUserProvider extends UserProvider
{
    public function __construct(HasherContract $hasher, $model)
    {
        parent::__construct($hasher, $model);
    }

    /**
     * 通过给定的凭据检索用户
     *
     * @param array $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        // && 优先级高于 ||
        if (empty($credentials) || (count($credentials) === 1 && Str::contains($this->firstCredentialKey($credentials), 'password'))) {
            // firstCredentialKey() 从凭据数组中获取第一个密钥
            return;
        }
        // 首先，我们将每个凭证元素作为where子句添加到查询中
        // 然后，我们可以执行查询，如果找到用户，则将其以 Eloquent 用户"模型"返回，该模型将由 Guard 实例使用
        $query = $this->newModelQuery();

        foreach ($credentials as $key => $value) {
            if (Str::contains($key, 'password')) {
                // 如果当前的 key 的值包含关键字 password 则跳过
                continue;
            }

            if (is_array($value) || $value instanceof Arrayable) {
                // instanceof 类型运算符：用于确定一个 PHP 变量是否属于某一类 class 实例
                $query->whereIn($key, $value);
            } elseif (Str::contains($key, 'account')) {
                $query->where('name', $value)->orWhere('email', $value)->orWhere('phone', $value);
            } else {
                $query->where($key, $value);
            }

            return $query->first();
        }
    }

    /**
     * 根据给定的凭据验证用户
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @param array $credentials
     * @return bool
     */
    public function validateCredentials(UserContract $user, array $credentials)
    {
        $plain = $credentials['password'];
        $authPassword = $user->getAuthPassword();

        return $this->hasher->check($plain . $authPassword['salt'], $authPassword['password']);
    }
}
