document.addEventListener("DOMContentLoaded", function () {

    document.getElementById('item1').style.display = "block"
    verticalTabs = document.querySelectorAll(".vertical-tabs a")


    function linkClickHandler(e) {
        e.preventDefault();

        clickItem = e.target.id;
        if (clickItem == 'content1') {
            document.getElementById('item2').style.display = "none"
            document.getElementById('item3').style.display = "none"
            document.getElementById('item4').style.display = "none"
            document.getElementById('item1').style.display = "block"

        } else if (clickItem == 'content2') {
            document.getElementById('item1').style.display = "none"
            document.getElementById('item3').style.display = "none"
            document.getElementById('item4').style.display = "none"
            document.getElementById('item2').style.display = "block"
        } else if (clickItem == 'content3') {
            document.getElementById('item1').style.display = "none"
            document.getElementById('item2').style.display = "none"
            document.getElementById('item4').style.display = "none"
            document.getElementById('item3').style.display = "block"
        }
        else if (clickItem == 'content4') {
            document.getElementById('item1').style.display = "none"
            document.getElementById('item2').style.display = "none"
            document.getElementById('item3').style.display = "none"
            document.getElementById('item4').style.display = "block"
        }
    }

    verticalTabs.forEach(link => {
        link.addEventListener('click', linkClickHandler);
    });
});