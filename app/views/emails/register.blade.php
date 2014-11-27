<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Регистрация</h2>
		<div>
            <p>Перейдите по этой <a href="{{URL::to('user/confirm/' . $confirmationCode)}}">ссылке</a> чтобы завершить регистрацию.</p>
		</div>
	</body>
</html>