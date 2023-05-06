<html>
    <body>
        <h1>Thư mời tham gia cuộc họp , {{ $userName }}!</h1>

        <div>
            Thông tin cuộc họp như sau:
        </div>
        <div>
            - ID cuộc họp:  {{ $meetingId}} <br/>
            - Tên cuộc họp : {{ $meetingName}} <br/>
            - Mật khẩu: {{ $meetingPassword }} <br/>
            - Link tham gia: {{ $joinUrl }}<br/>
        </div>
        <p>Nếu link tham gia bị, bạn có thể thử đăng nhập cuộc họp bằng Id/Password</p>
    </body>
</html>