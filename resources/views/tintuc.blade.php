<h1>VIEW TIN TỨC</h1>

<form action="/tin-tuc" method="POST">
    @csrf
    <input type="text" name="fullname" placeholder="Họ và tên">
    <input type="text" name="email" placeholder="Email">
    <button type="submit">Gửi</button>
</form>
