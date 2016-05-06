<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SPIn</title>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $("#submit_btn").click(function() { 
       
	    var proceed = true;
        //simple validation at client's end
        //loop through each field and we simply change border color to red for invalid fields		
		$("#contact_form input[required=true], #contact_form textarea[required=true]").each(function(){
			$(this).css('border-color',''); 
			if(!$.trim($(this).val())){ //if this field is empty 
				$(this).css('border-color','red'); //change border color to red   
				proceed = false; //set do not proceed flag
			}
			//check invalid email
			var email_reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/; 
			if($(this).attr("type")=="email" && !email_reg.test($.trim($(this).val()))){
				$(this).css('border-color','red'); //change border color to red   
				proceed = false; //set do not proceed flag				
			}	
		});
       
        if(proceed) //everything looks good! proceed...
        {
			//get input field values data to be sent to server
            post_data = {
				'user_name'		: $('input[name=name]').val(), 
				'user_email'	: $('input[name=email]').val(), 
				'country_code'	: $('input[name=phone1]').val(), 
				'phone_number'	: $('input[name=phone2]').val(), 
				'subject'		: $('select[name=subject]').val(), 
				'msg'			: $('textarea[name=message]').val()
			};
            
            //Ajax post data to server
            $.post('contact_me.php', post_data, function(response){  
				if(response.type == 'error'){ //load json data from server and output message     
					output = '<div class="error">'+response.text+'</div>';
				}else{
				    output = '<div class="success">'+response.text+'</div>';
					//reset values in all input fields
					$("#contact_form  input[required=true], #contact_form textarea[required=true]").val(''); 
					/*$("#contact_form #contact_body").slideUp(); //hide form after success*/
				}
				$("#contact_form #contact_results").hide().html(output).slideDown();
            }, 'json');
        }
    });
    
    //reset previously set border colors and hide all message on .keyup()
    $("#contact_form  input[required=true], #contact_form textarea[required=true]").keyup(function() { 
        $(this).css('border-color',''); 
        $("#result").slideUp();
    });
});
</script>
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/bootstrap-theme.css">
<link rel="stylesheet" href="css/estilo.css">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<script type="text/javascript" src="js/bootstrap.js"></script>  
</head>
<body>
   
   <!-- start navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon icon-bar"></span>
                        <span class="icon icon-bar"></span>
                        <span class="icon icon-bar"></span>
                    </button>
                    <a href="#" class="navbar-brand">
                        <img src="images/templatemo_logo.png">
                    </a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="http://spin.agr.br/#templatemo_home" class="smoothScroll">HOME</a></li>
                        <li><a href="http://spin.agr.br/#templatemo_about" class="smoothScroll">EMPRESA</a></li>
                        <li><a href="http://spin.agr.br/#templatemo_portfolio" class="smoothScroll">PRODUTOS</a></li>
                        <li><a href="http://spin.agr.br/#templatemo_blog" class="smoothScroll">SERVIÇOS</a></li>
                        <li><a href="http://spin.agr.br/email" class="smoothScroll">CONTATO</a></li>
                    </ul>
                </div>
            </div>              
        </div>
    </nav>
    <!-- end navigation -->


    <!-- Formulário - Inicío -->
    <div id="contact_form" class="contact_form animated fadeInDown">
       <div class="container">
           <div class="row">
               <div class="col-md-3">
                   <div id="contact_body">
                        <div class="form-group">
                           <input type="text" class="form-control" id="name" placeholder="Nome Completo" name="name" required="true">
                        </div>
                        <div class="form-group">
                           <input type="email" class="form-control" id="email" placeholder="Endereço de email" required="true" name="email">
                        </div>
   
                        <div class="form-inline">
                            <div class="form-group">
                               <input type="text" name="phone1" maxlength="4"   placeholder="DDD"  required="true" id="ddd"  class="form-control" style="width:80px;" />
                            </div>
                            <div class="form-group">
                               <input type="text" name="phone2" maxlength="15"  placeholder="Telefone" required="true" id="telefone" class="form-control"/>      
                            </div>
                        </div>
   
                        <div class="form-group" style="margin-top:15px">
                            <select name="subject" class="form-control">
                               <option value="Dúvidas Gerais">Dúvidas Gerais</option>
                               <option value="Orçamento">Orçamento</option>
                               <option value="Suporte Técnico">Suporte Técnico</option>
                               <option value="Parceria">Suporte Técnico</option>
                            </select>
                        </div>
                        <div class="form-group">
                           <input type="submit" id="submit_btn" value="Submit" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div id="contact_results" ></div>
                    <div class="form-group">
                       <textarea name="message" id="message" class="form-control" required="true" placeholder="Mensagem" style="height:200px"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Formulário - Fim -->

    <!-- Footer - Início -->
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="social-icons">
                        <ul>
                            <li><a href="https://www.facebook.com/spin.agr.br" class="fa fa-facebook"></a></li>
                            <li><a href="https://twitter.com/spin_agr_br" class="fa fa-twitter"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <p class="copyright-text">Copyright &copy; 2015 SPIn - Soluções para o Agronegócio </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer - Fim -->
</body>
</html>