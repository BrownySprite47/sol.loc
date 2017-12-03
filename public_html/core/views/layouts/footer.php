    <!-- <script src="//code.jquery.com/jquery-2.1.4.min.js"></script> -->
        <!-- <script src="/assets/bootstrap/js/jquery-3.2.1.min.js"></script> -->
    
    <!-- <script src="/assets/bootstrap/js/bootstrap.min.js"></script> -->
    <script type="text/javascript" src="/assets/js/typeahead.js"></script>
<script src="/assets/js/jquery.wallform.js"></script>

<script src="/assets/js/check_unic.js"></script>
<script type="text/javascript" src="/assets/bootstrap/js/bootstrap-datetimepicker.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="/assets/bootstrap/locales/bootstrap-datetimepicker.ru.js" charset="UTF-8"></script>
<script src="/assets/js/script.js"></script>
<script src="/assets/js/scripts.js"></script>
<!-- <script type="text/javascript" src="/assets/bootstrap/js/bootstrap.min.js"></script> -->
<script src="/assets/bootstrap/js/bootstrap-select.js"></script>
<script>
    $('#title.selectpicker').selectpicker({ size: 4 });
    $('#city.selectpicker').selectpicker({ size: 4 });
</script>
<div>
    <div id="backdrop" class=""></div>
</div>
<?php if(ANALYTICS): ?>
    <script type="text/javascript" >
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter45694533 = new Ya.Metrika({
                        id:45694533,
                        clickmap:true,
                        trackLinks:true,
                        accurateTrackBounce:true,
                        webvisor:true
                    });
                } catch(e) { }
            });

            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else { f(); }
        })(document, window, "yandex_metrika_callbacks");
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/45694533" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<?php endif; ?>
</body>
</html>











