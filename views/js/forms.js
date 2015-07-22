/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/18/2015
 * Time: 03:05 PM
 */

function HtmlSelectOptions_Months(parent_id, selected_option){
    var options = "";
    var months = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"];
    for(var i = 0; i < months.length; ++i){
        options += "<option value=\""+ (i+1) + "\"";
        options += ((i+1) == selected_option ) ? "selected" : "";
        options += ">"+ months[i] +"<\/option>";
    }
    document.getElementById(parent_id).innerHTML += options;
}
