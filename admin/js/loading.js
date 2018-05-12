$(document).ready(function(){
	$('#element').introLoader({
                 animation: {
                name: 'gifLoader',
                options: {
                ease: "easeInOutCirc",
                style: 'light bubble',
                delayBefore: 700,
                delayAfter: 0,
                exitTime: 300
            }
        }
            });
});
