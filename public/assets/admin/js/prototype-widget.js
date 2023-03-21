jQuery(document).ready(function(){
    jQuery('.add-new-element-widget').click(function(e){
        let list = jQuery(jQuery(this).attr('data-list-selector'));
        let counter = list.data('widget-counter') || list.children().length;
        let newWidget = list.attr('data-prototype');
        newWidget = newWidget.replace(/__name__/g, counter);
        counter++;
        list.data('widget-counter', counter);
        let newElem = jQuery(list.attr('data-widget-tags')).html(newWidget);
        newElem.appendTo(list);
    });

    jQuery('body').on('click', '.delete-btn-widget', function(e){
        let list = jQuery(jQuery(this).attr('data-list'));
        let removeElem = jQuery(jQuery(this).attr('data-delete'));
        let counter = list.data('widget-counter') || list.children().length;
        counter--;
        list.data('widget-counter', counter);
        removeElem.remove();
    });
});