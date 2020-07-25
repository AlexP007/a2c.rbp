// animated icon
!(function(){
    const icon = $("a[href^='#'][data-type='rbp-animated-icon']");
    const scrollContainerSelector = icon.data('selector');
    // icon fade out on scrolling
    if (scrollContainerSelector) {
        const scrollContainer = $(scrollContainerSelector);
        scrollContainer.on('scroll', () => {
            if (scrollContainer.scrollTop() > 20) {
                mouseBtn.fadeOut(200);
            } else {
                mouseBtn.fadeIn(200);
            }
        });
        // smooth transition
        icon.on("click", function (e) {
            e.preventDefault();
            let hash = this.hash;

            scrollContainer.stop().animate({
                scrollTop: $(hash).offset().top
            }, 777);
            return false;
        });
    }
})();