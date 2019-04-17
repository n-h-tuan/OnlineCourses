<form role="form" action="http://localhost:8000/api/Login" method="POST">
    {{-- <input type="hidden" name="_token" value="{{csrf_token()}}" /> --}}
    <div>
        <label>Email</label>
        <input type="email" class="form-control" placeholder="Email" name="email">
    </div>
    <br>	
    <div>
        <label>Mật khẩu</label>
          <input type="password" class="form-control" name="password">
    </div>
    <br>
    <button type="submit" class="btn btn-default">Đăng nhập
    </button>
</form>