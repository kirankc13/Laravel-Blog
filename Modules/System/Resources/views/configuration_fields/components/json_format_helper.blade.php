<div class="modal bd-example-modal-lg in" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                    <i class="font-icon-close-2"></i>
                </button>
                <h4 class="modal-title" id="myModalLabel">Formatting JSON for configuration fields</h4>
            </div>
            <div class="modal-body">
            <div class="row">
                <div class="col-lg-6 col-xs-12 b-l">
                <h5 style="margin-bottom: 0px;">Checkbox</h5>
                <pre>
                <code>
{
    "on" : "On Text",
    "off" : "Off Text",
    "checked" : true
}
                </code>
                </pre>
                </div> 
                <div class="col-lg-6 col-xs-12">
                <h5 style="margin-bottom: 0px;">Multiple Checkbox</h5>
                <pre>
                <code>
{
    "checked" : true,
    "options": {
        "checkbox1": "Checkbox 1 Text",
        "checkbox2": "Checkbox 2 Text"
    }
}
                </code>
                </pre>
                </div>  
                <div class="col-lg-6 col-xs-12">
                <h5 style="margin-bottom: 0px;">Radio Button</h5>
                <pre>
                <code>
{
    "default" : "radio1",
    "options" : {
        "radio1": "Radio Button 1 Text",
        "radio2": "Radio Button 2 Text"
    }
}
                </code>
                </pre>
                </div>  
                <div class="col-lg-6 col-xs-12">
                <h5 style="margin-bottom: 0px;">Select Dropdown</h5>
                <pre>
                <code>
{    
    "options": {
        "dropdown1": "Dropdown 1 Text",
        "dropdown2": "Dropdown 2 Text",
        "dropdown3": "Dropdown 3 Text",
    }
}
                </code>
                </pre>
                </div>                                                  
            </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>                
            </div>
        </div>
    </div>
</div>