<?php

function action_index() {
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = [
            'email' => dbSaveData(trim($_POST['email'])),
            // 'password' => dbSaveData(trim($_POST['password'])),
            'password' => dbSaveData(trim(md5($_POST['password'] . KEY))),
            // $data['password'] = md5($data['password'] . KEY);
        ];

        $rules = [
            'email' => ['required', 'email'],
            'password' => ['required', 'password'],
        ];

        $messages = [
            'required' => "Поле обязательно для заполнения",
            'email' => "Введите корректный email от 5 до 30 символов",
            'password' => "Пароль может содержать только буквы и цифры от 5 до 30 символов",
        ];

        $errors = validateForm($rules, $data);

        if (empty($errors)) {
            require SITE_DIR . '/core/models/user.php';

            $user = getUserLogin($data);

            if ($user->num_rows === 0) {
                $messages['not_unique'] = 'Данный пользователь не существует';
            } else {
                $_SESSION = mysqli_fetch_assoc($user);
                header("Location: /");
            }
        }
    }

    $data['errors'] = $errors;
    $data['messages'] = $messages;
    renderView('login', $data);
}

function action_success() {
    $data['status'] = 'success';
    renderView('registration', $data);
}
