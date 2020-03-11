
        </div>
    </div>

    <!-- Menu Toggle Script -->
    <script>
        $(function() {
            $("#menu-toggle").click(function(e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });

            $(window).resize(function(e) {
                if ($(window).width() <= 768) {
                    $("#wrapper").removeClass("toggled");
                } else {
                    $("#wrapper").addClass("toggled");
                }
            });
        });
    </script>

</html>

</body>

</html>