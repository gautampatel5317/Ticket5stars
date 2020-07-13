<?php

return [
	'messages'       => [
		'registeration' => [
			'success'      => 'あなたが正常に登録されています。',
		],
		'login'    => [
			'success' => 'ログイン成功。',
			'failed'  => '無効な資格情報！',
		],
		'logout'   => [
			'success' => 'ログアウトに成功しました。',
		],
		'token'          => [
			'token_expire'  => 'トークンの有効期限が切れました！',
            'token_invalid' => 'トークンは無効です！',
            'token_missing' => 'トークンがありません！',
		],

		'forgot_password'   => [
			'success'          => 'パスワードのリセットリンクを記載したメールを送信しました。',
			'validation'       => [
				'email_not_found' => 'このメールアドレスは登録されていません。',
			],
		],
		'refresh'        => [
			'token'         => [
				'not_provided' => 'トークンが提供されていません。',
			],
			'status' => 'OK',
		],
	],

];
