<form role="form" action="https://khoahocdt.com/api/User/10" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="PUT">
    <div>
        <label>Name</label>
        <input type="text" class="form-control" placeholder="Name" name="name" value="ABC">
    </div>
    <br>	
    <div>
        <label>Ngày Sinh</label>
          <input type="text" class="form-control" placeholder="Ngày Sinh" name="NgaySinh" value="03-06-1997">
    </div>
    <div>
        <label>Số điện thoại</label>
          <input type="text" class="form-control" name="SoDienThoai" value="0961244398">
    </div>
    <div>
        <label>Hình Ảnh</label>
          <input type="file" class="form-control" name="HinhAnh">
    </div>
    <br>
    <button type="submit" class="btn btn-default">Gửi request
    </button>
</form>