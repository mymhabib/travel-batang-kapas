            </div>
            </div>
            <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.js"></script>
            <script src="<?= BASEURL; ?>js/script.js"></script>


            <script type="text/javascript">
                $(document).ready(function() {
                    $('#sidebarCollapse').on('click', function() {
                        $('#sidebar').toggleClass('active');
                        $(this).toggleClass('active');
                    });
                    // Save collapsible state
                    const collapseExample = $("#proyekSubmenu");

                    collapseExample.on("shown.bs.collapse", function() {
                        localStorage.setItem("collapseExample", "show");
                        collapseExample.removeClass("not-collapsing");
                    });

                    collapseExample.on("hidden.bs.collapse", function() {
                        localStorage.setItem("collapseExample", "hide");
                        collapseExample.removeClass("not-collapsing");
                    });

                    const showExampleCollapse = localStorage.getItem("collapseExample");

                    if (showExampleCollapse === "show") {
                        collapseExample.toggleClass("not-collapsing");
                        collapseExample.collapse("show");
                    } else {
                        collapseExample.collapse("hide");
                    }
                });
            </script>
            </body>

            </html>