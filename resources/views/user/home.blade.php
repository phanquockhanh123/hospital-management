  @include('user.header')
  @include('user.banner')
  

  @include('user.about')
  

  <script>
      @if (Session::has('success'))
        showToastMessage("Guest added successfully test2")
          .delay(5000)
          .fadeOut(4000);
      @endif
  </script>
  @include('user.appointment')

  @include('user.doctor')


  @include('user.lastest')
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.6094175111193!2d105.79351121457799!3d21.00828818600949!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ad09966c771d%3A0xb7452a901ca9f4c0!2zUGjDsm5nIEtow6FtIMSQYSBLaG9hIFRodSBDw7pjIChUQ0kp!5e0!3m2!1svi!2s!4v1678201284539!5m2!1svi!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

  @include('user.footer')