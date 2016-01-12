<div id='jqxTree'>

</div>
        <div id='jqxMenu'>
            <ul>
                <li><span class="fa fa-plus-square"></span> Add</li>
                <li><span class="fa fa-trash"></span> Remove</li>
            </ul>
        </div>
        </div><!-- /.modal -->
        <script type="text/javascript">
            // // Create jqxTree

            $('#jqxTree').jqxTree({
                height: '400px',
                width: '300px',
            });
            $('#jqxTree').css('visibility', 'visible');
            var contextMenu = $("#jqxMenu").jqxMenu({ width: '120px',  height: '56px', autoOpenPopup: false, mode: 'popup' });
            var clickedItem = null;

            var attachContextMenu = function () {
                // open the context menu when the user presses the mouse right button.
                $("#jqxTree li").on('mousedown', function (event) {
                    var target = $(event.target).parents('li:first')[0];

                    var rightClick = isRightClick(event);
                    if (rightClick && target != null) {
                        $("#jqxTree").jqxTree('selectItem', target);
                        var scrollTop = $(window).scrollTop();
                        var scrollLeft = $(window).scrollLeft();

                        contextMenu.jqxMenu('open', parseInt(event.clientX) + 5 + scrollLeft, parseInt(event.clientY) + 5 + scrollTop);
                        return false;
                    }
                });
            }
            attachContextMenu();
            $("#jqxMenu").on('itemclick', function (event) {
                var item = $.trim($(event.args).text());
                switch (item) {
                    case "Add":
                        var selectedItem = $('#jqxTree').jqxTree('selectedItem');
                        if (selectedItem != null) {
                            // $('#jqxTree').jqxTree('addTo', { label: 'Item' }, selectedItem.element);
                            var item = $('#jqxTree').jqxTree('getItem', selectedItem.element);
                            $(".modal-title").html('Add Sub '+item.label);
                            $("input[name=node_name]").val(item.label);
                            $("#modal-addsub").modal('show');
                            // attachContextMenu();
                        }
                        break;
                    case "Remove":
                        var selectedItem = $('#jqxTree').jqxTree('selectedItem');
                        if (selectedItem != null) {
                            $('#jqxTree').jqxTree('removeItem', selectedItem.element);
                            attachContextMenu();
                        }
                        break;
                }
            });

            // disable the default browser's context menu.
            $(document).on('contextmenu', function (e) {
                if ($(e.target).parents('.jqx-tree').length > 0) {
                    return false;
                }
                return true;
            });

            function isRightClick(event) {
                var rightclick;
                if (!event) var event = window.event;
                if (event.which) rightclick = (event.which == 3);
                else if (event.button) rightclick = (event.button == 2);
                return rightclick;
            }
        </script>