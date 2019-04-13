<div class="div">
    <h2 style="color:grey"> Online Courses </h2>
    <br>
    <h1 style="color:cornflowerblue"> Xác thực Email </h1>
    <br>
    <p>Cám ơn {{$user->name}} đã đăng ký thành viên tại Online Courses.</p>
    <p>Nhấn vào nút dưới đây để xác thực địa chỉ email.</p>
    <p><a href="http://localhost:8000/api/Mail/Verify/{{$user->id}}" class="m_-8497879697059558707button m_-8497879697059558707button-primary" style="font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';box-sizing:border-box;border-radius:3px;color:#fff;display:inline-block;text-decoration:none;background-color:#3490dc;border-top:10px solid #3490dc;border-right:18px solid #3490dc;border-bottom:10px solid #3490dc;border-left:18px solid #3490dc" target="_blank">Verify Email Address</a></p>
    <p>Hoặc bạn có thể nhấn vào đường dẫn này nếu không thực hiện được với nút xác thực trên: <a href="http://localhost:8000/api/Mail/Verify/{{$user->id}}"> http://localhost:8000/api/Mail/VerifyEmail/{{$user->id}} </a></p>
    <p>Nếu có vấn đề xảy ra vui lòng liên hệ về địa chỉ email <b style="color:goldenrod"> dtonlinecourse@gmail.com </b></p>
    Thân ái,
    <br>
    Online Courses
</div>