<?php

function action_index() {
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $data = [
            'login' => dbSaveData(htmlspecialchars(trim($_POST['login']))),
            'email' => dbSaveData(trim($_POST['email'])),
            'password' => dbSaveData(trim($_POST['password'])),
            'password2' => dbSaveData(trim($_POST['password2'])),
        ];

        $rules = [
            'login' => ['required', 'login'],
            'email' => ['required', 'email'],
            'password' => ['required', 'password'],
            'password2' => ['required', 'password2'],
        ];

        $messages = [
            'required' => "Поле обязательно для заполнения",
            'login' => "Логин может содержать только буквы и цифры от 5 до 30 символов",
            'email' => "Введите корректный email от 5 до 30 символов",
            'password' => "Пароль может содержать только буквы и цифры от 5 до 30 символов",
            'password2' => "Пароль может содержать только буквы и цифры от 5 до 30 символов",
            'equal' => "Пароли должны совпадать",
        ];

        $errors = validateForm($rules, $data);

        if (empty($errors)){
        $data['password'] = md5($data['password'] . KEY);

            require SITE_DIR . '/core/models/user.php';
            require SITE_DIR . '/core/models/lider.php';

            $user = getUser($data);

            if ($user->num_rows === 0){
                if (addNewUser($data) && addNewLider($data)){
                    header('Location: /login?reg=success');
                }else{
                    $messages['unique'] = 'Ошибка регистрации. Повторите попытку позже';
                }
            }else{
                $messages['unique'] = 'Данный пользователь уже существует';
            }
        }
    }
    $data['errors'] = $errors;
    $data['messages'] = $messages;
    renderView('registration', $data);
}
