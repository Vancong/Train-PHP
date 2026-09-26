<?php
class AuthenService
{
    private UserModel $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function login(string $email, string $password)
    {
        $user = $this->model->findByEmail($email);
        if (!$user) {
            return null;
        }
        if (!password_verify($password, $user['password'])) {
            return null;
        }

        return $user;
    }

    public function register(string $email, string $password)
    {
        $user = $this->model->findByEmail($email);
        if ($user) {
            return null;
        }
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        return $this->model->register($email, $passwordHash);
    }
}
