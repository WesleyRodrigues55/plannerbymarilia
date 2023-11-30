document.addEventListener("DOMContentLoaded", function () {

    document.getElementById('item1').style.display = "block"
    verticalTabs = document.querySelectorAll(".vertical-tabs a")



    function anchor(link, content) {
        var larguraDaTela = window.innerWidth;
        if (larguraDaTela <= "767") {
            var elementoAnchor = document.getElementById(link);
            elementoAnchor.setAttribute('href', '#' + content);
        }
    }

    function linkClickHandler(e) {
        // e.preventDefault();

        clickItem = e.target.id;
        if (clickItem == 'content1') {
            document.getElementById('item2').style.display = "none"
            document.getElementById('item3').style.display = "none"
            document.getElementById('item4').style.display = "none"
            document.getElementById('item1').style.display = "block"
            anchor('content1', 'item1')

        } else if (clickItem == 'content2') {
            document.getElementById('item1').style.display = "none"
            document.getElementById('item3').style.display = "none"
            document.getElementById('item4').style.display = "none"
            document.getElementById('item2').style.display = "block"
            anchor('content2', 'item2')
        } else if (clickItem == 'content3') {
            document.getElementById('item1').style.display = "none"
            document.getElementById('item2').style.display = "none"
            document.getElementById('item4').style.display = "none"
            document.getElementById('item3').style.display = "block"
            anchor('content3', 'item3')
        }
        else if (clickItem == 'content4') {
            document.getElementById('item1').style.display = "none"
            document.getElementById('item2').style.display = "none"
            document.getElementById('item3').style.display = "none"
            document.getElementById('item4').style.display = "block"
            anchor('content4', 'item4')
        }
    }

    verticalTabs.forEach(link => {
        link.addEventListener('click', linkClickHandler);
    });
});