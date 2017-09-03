//Login_Forms('registration_field-form-fields',1,0,"registration_field-signup-btn");

class Login_Forms{
	constructor(login_forms_class, show, hide, form_btn){
		var obj = this;
		this.form_show = document.getElementsByClassName(login_forms_class)[show];
		this.form_hide = document.getElementsByClassName(login_forms_class)[hide];
		this.form_btn = document.getElementsByClassName(form_btn)[0];
		this.form_btn.onclick = function(){
			obj.formToggle();
		}
	}
	formToggle(){
		$(this.form_hide).slideUp();
		$(this.form_show).slideToggle();
		this.form_show.style.display = "flex";
	}
}

