jQuery(document).bind("omeka:elementformload", function() {
    jQuery("select.taxonomy-open").each(function() {
        jQuery(this).change(function() {
            var val = jQuery(this).val();
            if (val == 'insert_new_term') {
                jQuery(this).next('input.taxonomy-open').show();
                jQuery(this).parent().find('button.taxonomy-open').show();
                jQuery(this).parent().find('p.taxonomy-open').show();
            } else {
                jQuery(this).next('input.taxonomy-open').hide();
                jQuery(this).parent().find('button.taxonomy-open').hide();
                jQuery(this).parent().find('p.taxonomy-open').hide();
            }
        }).change();

        jQuery("button.taxonomy-open").click(function(){
            var field = jQuery(this).parent().find('input.taxonomy-open');
            var val = field.val().trim();
            if (val.length == 0) {
                return;
            }
            var select = jQuery(this).parent().find('select.taxonomy-open');
            var exists = false;
            select.find('option').each(function(){
                if (this.value == val) {
                    exists = true;
                    return false;
                }
            });
            if (!exists) {
                var insertNewTerm = select.children("option[value='insert_new_term']")[0].outerHTML;
                select.children("option[value='insert_new_term']").remove();
                select.append('<option value="' + val + '">' + val + '</option>');
                select.append(insertNewTerm);
            }
            select.val(val);
            field.val('').hide();
            jQuery(this).hide();
            jQuery(this).parent().find('p.taxonomy-open').hide();
        });
    });
});
