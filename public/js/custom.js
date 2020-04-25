function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}



$('#role').on('change', function() {
    if(this.value == 1){
        $('.class').hide();
        $('.student').hide();
        $('.level').hide();
    }else if(this.value == 2){
        $('.class').show();
        $('.student').hide();
        $('.level').show();
    }else if(this.value == 3){
        $('.class').hide();
        $('.student').show();
        $('.level').hide();
    }
    else if(this.value == 4){
    $('.class').show();
    $('.student').hide();
    $('.level').show();
}
});

