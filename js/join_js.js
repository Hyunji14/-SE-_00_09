<script type="text/javascript">
    function oneCheckbox(a){
        var obj = document.getElementsByName("checkbox1");
        for(var i=0; i<obj.length; i++){
            if(obj[i] != a){
                obj[i].checked = false;
            }
        }
    }
</script>