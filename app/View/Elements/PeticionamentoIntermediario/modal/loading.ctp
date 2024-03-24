<div id="customLoading" style="display: none; text-align: center; font-weight: bold;">
    <div id="innerLoading">
        Processando...
        <?php echo $this->Html->image('ajaxBarGreen.gif'); ?>
    </div>
</div>

<script>
    
    function showCustomLoading(){
        $('#customLoading').show();
    }
    
    function hideCustomLoading(){
        setTimeout(function() {   
            $('#customLoading').hide();
        }, 1000);
    }
    
</script>