// animated icon
$(document).ready(function(){
    const icon = $("a[href^='#'][data-type='rbp-animated-icon']");
    const scrollContainerSelector = icon.data('selector');
    let usePosition = true;
    if (scrollContainerSelector.incluedes('body') || scrollContainerSelector.incluedes('html')) {
        usePosition = false;
    }
    const scrollContainer = $(scrollContainerSelector);
    // icon fade out on scrolling
    if (icon.length > 0 && scrollContainer.length > 0) {
        scrollContainer.on('scroll', () => {
            if (scrollContainer.scrollTop() > 20) {
                icon.fadeOut(200);
            } else {
                icon.fadeIn(200);
            }
        });
        // smooth transition
        icon.on("click", function(e) {
            e.preventDefault();
            let hash = this.hash;
            let top = usePosition ? $(hash).position().top : $(hash).offset().top;
            scrollContainer.stop().animate({
                scrollTop: top
            }, 777);
            return false;
        });
    }
})();