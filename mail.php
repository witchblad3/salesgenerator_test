<?php
$to = "order@salesgenerator.pro";
$phone = $_POST['phone'];
$email = $_POST['email'];
$subject = "Заявка с сайта";
$message = "Телефон: " . $phone;

$headers = [
    'From' => $email,
    'Reply-To' => 'order@salesgenerator.pro',
    'Content-Type' => ' text/html; charset=utf-8',
];

if ($_POST['email'] and $_POST['phone'] !== null) {
    $email_sent = mail($to, $subject, $message, $headers);
    if ($email_sent) {
        echo "Ваша сообщение отправлено на почту";
        echo '<br>';
    } else {
        echo "Произошла ошибка";
    }
}


// Данные для аутентификации в amoCRM
$subdomain = 'irochkapetrova2003';
$userLogin = 'irochka.petrova.2003@bk.ru';
$accessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjljNWJmMTY0ZjFiYTc0ZjMyM2RhYzQzZDY5NTY4M2Y5MzkxNTJhYjBmMGExZTQ3MjRmYjc1OWQxNTQ3MGZiMjE0ZTg3NzRmM2M0NThkYTYwIn0.eyJhdWQiOiJhMGMxMTUxNi01NzYxLTQzM2QtODNlNC1jZjk3ODczZjU1M2YiLCJqdGkiOiI5YzViZjE2NGYxYmE3NGYzMjNkYWM0M2Q2OTU2ODNmOTM5MTUyYWIwZjBhMWU0NzI0ZmI3NTlkMTU0NzBmYjIxNGU4Nzc0ZjNjNDU4ZGE2MCIsImlhdCI6MTcwOTgzMDY3NCwibmJmIjoxNzA5ODMwNjc0LCJleHAiOjE3MTAxMTUyMDAsInN1YiI6IjEwNzI4NTE4IiwiZ3JhbnRfdHlwZSI6IiIsImFjY291bnRfaWQiOjMxNTk2NTcwLCJiYXNlX2RvbWFpbiI6ImFtb2NybS5ydSIsInZlcnNpb24iOjIsInNjb3BlcyI6WyJjcm0iLCJmaWxlcyIsImZpbGVzX2RlbGV0ZSIsIm5vdGlmaWNhdGlvbnMiLCJwdXNoX25vdGlmaWNhdGlvbnMiXSwiaGFzaF91dWlkIjoiMTg1MDg3OGEtZWM3ZC00NDA5LWJiOGItMTFiZmFmZDZiMjY0In0.jG6F7FgERHeMjEEwICj4wMjrQEI-u61XMwbMm0bvNViXnjni23sIvGGO-JOpq7m9rqr4t72fFaFhMyyVTF_IFQ-RmIwZXCgreHBkNZkgjOkS01bKXYaQRe2imZxnW4gccLRlp7CqswyYjHd4hiuO95JJ6AUgWjvq9KXnxvCgLuE9VYp93bxW2JSetn_X4dlobC85ZcF8vrOD0sLZLYWTWG1uIGNOX4cXkReR_sNlMDKiDbgp2-Q9EdjmkHP3AYpHU9vn7S39nzso_eB5Z2td9_K_QQzF4z5xhNM01I3TT-RyGrE4lfPWKOArTNpOmTcTj8UeJ24bUu6O10xs9_G-HQ';
$phoneFieldId = 678125;
$emailFieldId = 678127;

// Данные для создания заявки
$leadData = [
    [
        "name" => "Заявка Столбов",
        "price" => 20000000000,
        "_embedded" => [
            'contacts' => [
                [
                    'first_name' => $email,
                    'responsible_user_id' => 10728518,
                    'custom_fields_values' => [
                        [
                            'field_id' => $phoneFieldId,
                            'values' => [
                                [
                                    'value' => $phone
                                ]
                            ]
                        ],
                        [
                            'field_id' => $emailFieldId,
                            'values' => [
                                [
                                    'value' => $email
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ]
];

// Создание заявки в amoCRM
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://{$subdomain}.amocrm.ru/api/v4/leads/complex");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($leadData));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type: application/json",
    "Authorization: Bearer {$accessToken}"
));
$response = curl_exec($ch);
curl_close($ch);

// Проверка успешности создания заявки
$responseData = json_decode($response, true);
//var_dump($responseData);
if (isset($responseData[0]['id'])) {
    echo "Заявка успешно создана с ID {$responseData[0]['id']}";
} else {
    echo "Произошла ошибка при создании заявки";
}





