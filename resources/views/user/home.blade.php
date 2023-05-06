  @include('user.header')
  @include('user.banner')
  {{-- @include('user.about') --}}
  
  <script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
  </script>
  @include('user.appointment')

  @include('user.doctor')

  @include('user.lastest')
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d234.813370985976!2d105.53426471069368!3d19.66941083988365!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3136e242a1c2c51d%3A0x8b018096fbf69b7d!2zUGjDsm5nIEtow6FtIMSQYSBLaG9hIEFuIEtoYW5n!5e0!3m2!1svi!2s!4v1683126902676!5m2!1svi!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

  @include('user.footer')