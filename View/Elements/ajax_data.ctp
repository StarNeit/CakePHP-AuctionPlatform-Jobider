<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-65832262-1', 'auto');
  ga('send', 'pageview');

</script>
        <script>
            $(document).ready(function () {
                $(document).on('click', '.more', function () {
                    $(this).parent().parent().next().removeClass('hide');
                    $(this).parent().parent().addClass('hide');
                });

            });
            $(document).ready(function () {
                $(document).on('click', '.less', function () {
                    $(this).parent().parent().prev().removeClass('hide');
                    $(this).parent().parent().addClass('hide');

                });
            });
        </script>
        
      <script>
            if (window.location.hash && window.location.hash == '#_=_') {
                window.location.hash = '';
            }
        </script>
      
