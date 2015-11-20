"use strict";window.innerWidth<=100&&-1==window.location.pathname.indexOf("mobile.html")&&(window.location="/mobile.html"),jQuery(function(a){function b(){var b=a(".pages_container"),c=300;setTimeout(function(){if(!b.is(":animated")){var d=a(a("#nav li.active a").attr("href")),e=d.offset().left,f=parseInt(d.css("margin-left")),g=e-f;(c>=g&&g>0||g>=-c&&0>g)&&a(d).scrollView(d,1e3)}},300)}function c(){var c=a(window).width(),d=a(".pages_container"),e=a(".pages");a("html, body").mousewheel(function(f,g){return a(".bottom_popup").hasClass("open")?void 0:(f.preventDefault(),n.wheel=!0,0>g?(n.left=n.left+c>=e.width()?n.left:n.left+=n.step,d.stop().animate({scrollLeft:n.left},n.duration,n.easing,function(){n.wheel=!1,b()})):(n.left=n.left<=0?0:n.left-=n.step,d.stop().animate({scrollLeft:n.left},n.duration,n.easing,function(){n.wheel=!1,b()})),!1)}),a(window).on("resize",function(){c=a(this).width()}),d.on("scroll",function(){n.wheel||(n.left=a(this).scrollLeft())})}function d(){a(".container").each(function(){var b=a(this),c=b.width();m>c&&b.css({padding:"0 "+(m-c)/2+"px"})})}function e(){for(var b=a(".pages, .backgrounds"),c=b.find(".container"),d=0,e=0;e<c.length;e++)d+=a(c).eq(e).outerWidth(!0);b.css("width",d+"px")}function f(){var b=a("#nav"),c=b.find("li.active a"),d=c.data("page"),e=c.attr("href");a("#site").removeClass().addClass(d),"#stores"==e?o=setInterval(h,2e3):window.clearInterval(o)}function g(){var b=window.location.hash,c=a("#site").attr("class"),d=a("#nav").find('[href="'+b+'"]');d.data("page")!=c&&d.trigger("click")}function h(){var b=p[s],c=document.createElement("img"),d=Math.floor(Math.random()*t.length),e=t[d];a(c).load(function(){var b=q.find("li").eq(e);b.addClass("zoom_out").append('<div class="cover"></div>').find(".cover").animate({top:0},150,function(){b.find("img").replaceWith(c),b.find(".cover").delay(0).animate({top:"-100%"},0,function(){a(this).remove(),b.removeClass("zoom_out")})}),s<p.length-1?s++:s=0,t.splice(d,1),0===t.length&&(t=[0,1,2,3,4,5,6,7,8,9])}),c.src="images/stores/"+b+".png"}function i(){var b=a("#team"),c=0;b.find(".member").each(function(){c+=a(this).outerWidth(!0)}),b.css({width:c})}function j(){var b=parseInt(a("#home").outerWidth(!0)),c=parseInt(a("#stores").outerWidth(!0)),d=parseInt(a("#team").outerWidth(!0)),e=parseInt(a("#hiring").outerWidth(!0));v.addTween(0,TweenMax.fromTo(a(".nav_line"),.1,{css:{width:k(0),left:l(0),backgroundColor:"#D35566"}},{css:{width:k(1),left:l(1),backgroundColor:"#FFA64D"}}),b),v.addTween(0,TweenMax.fromTo(a("#footer"),.1,{css:{borderColor:"#D35566"}},{css:{borderColor:"#FFA64D"}}),b),v.addTween(0,TweenMax.fromTo(a(".backgrounds"),.1,{css:{marginTop:0}},{css:{marginTop:"-35px"}}),b),v.addTween(b,TweenMax.to(a(".nav_line"),.1,{css:{width:k(2),left:l(2),backgroundColor:"#64A050"}}),c),v.addTween(b,TweenMax.to(a("#footer"),.1,{css:{borderColor:"#64A050"}}),c),v.addTween(b,TweenMax.to(a(".backgrounds"),.1,{css:{marginTop:"-80px"}}),c),v.addTween(b+c,TweenMax.to(a(".nav_line"),.1,{css:{width:k(3),left:l(3),backgroundColor:"#0679D8"}}),d),v.addTween(b+c,TweenMax.to(a("#footer"),-.1,{css:{borderColor:"#0679D8"}}),d),v.addTween(b+c+d,TweenMax.to(a(".nav_line"),.1,{css:{width:k(4),left:l(4),backgroundColor:"#79387F"}}),e),v.addTween(b+c+d,TweenMax.to(a("#footer"),.1,{css:{borderColor:"#79387F"}}),e)}function k(b){var c=a("#nav li").eq(b).find("a"),d=c.width();return d}function l(b){var c=a("#nav li").eq(b).find("a"),d=c.position().left;return d}var m=a(window).outerWidth();a(window).on("resize",function(){m=a(window).outerWidth(),d(),e(),a('[data-spy="scroll"]').each(function(){a(this).scrollspy("refresh")})}).on("load",function(){i(),e(),a('[data-spy="scroll"]').each(function(){a(this).scrollspy("refresh")}),c(),a("#site").animate({opacity:1}),a(".pages_container").stellar({horizontalScrolling:!0,verticalScrolling:!1})}),a.extend(a.easing,{def:"easeOutExpo",easeOutExpo:function(a,b,c,d,e){return b==e?c+d:d*(-Math.pow(2,-10*b/e)+1)+c}}),a("textarea, input").not('input[type="submit"]').focus(function(){this.value===this.defaultValue&&(this.value="")}),a("textarea, input").blur(function(){""==a.trim(this.value)&&(this.value=this.defaultValue?this.defaultValue:"")});a(".register_form form").validate({rules:{email:{required:!0,email:!0}},submitHandler:function(){var b=a("#email").val();a.ajax({type:"POST",url:"/api/v1/client/beta-registration",data:JSON.stringify({email:b}),success:function(b){200==b.meta.code&&(a(".register_form form").slideUp(300),a(".register_form .success").slideDown(300))},error:function(b){a(".register_form form").slideUp(300),a(".register_form .failure").slideDown(300)}})}});a(".register_form form").on("submit",function(a){a.preventDefault()});var n={left:0,step:80,duration:1500,easing:"easeOutExpo",wheel:!1};d(),a("ul.nav li").on("activate",function(a){f()});var o;a.fn.scrollView=function(b,c){return c="undefined"==typeof c?1500:c,this.each(function(){var d=a(".pages_container"),e=-parseInt(a(b).css("margin-left"));d.stop().animate({scrollLeft:d.scrollLeft()+a(b).offset().left-d.offset().left+e},c,function(){n.left=a(".pages_container").scrollLeft()})})},a("#nav a").on("click",function(b){var c=a(this).attr("href");b.preventDefault(),a(c).scrollView(c)}),g(),a(".tabs .tabs_nav").on("click","li:not(.active)",function(){var b=a(this),c=b.addClass("active").siblings().removeClass("active").parents(".tabs").find(".tab").eq(b.index());c.addClass("active").fadeIn(150).siblings().hide().removeClass("active")}),function(){a("body").on("click","[data-popup]",function(b){n.wheel=!1;var c=a("#"+a(this).data("popup")),d=a("#site");a(".bottom_popup.open").length>0?(a(".bottom_popup").not(c).removeClass("open"),a(".bottom_popup.open").attr("id")==a(this).data("popup")&&(d.removeClass("blur"),a("#overlay").fadeOut(200))):(d.hasClass("blur")?d.removeClass("blur"):setTimeout(function(){d.addClass("blur")},800),a("#overlay").fadeToggle(200)),c.toggleClass("open"),b.preventDefault()}),a("#overlay, .popup_close").on("click",function(){a("#overlay").fadeOut(200),a("#site").removeClass("blur"),a(".bottom_popup").removeClass("open")})}();for(var p=["bebe","bed","bodyshop","br","carters","cb2","chicos","crate","cwonder","disney","dkny","gap","kate","levis","loft","logos_aeropostale","mac","macys","neiman","nike","nordstrom","oldnavy","oshkosh","pucsun","puma","ralph","sephora","stride","stuart","tory","urban"],q=a("#stores_panel ul"),r="",s=10,t=[0,1,2,3,4,5,6,7,8,9],u=0;s>u;u++)r+='<li><img src="images/stores/'+p[u]+'.png"></li>';q.html(r),a.getJSON("/images/data/team.json",function(b){var c="",f="",g="",h=a("#team_popup").hide(),k=[];a.each(b,function(a,b){c+='<li class="member" data-index="'+a+'" data-popup="team_popup" style="margin-left:'+b.offsetLeft+";margin-top:"+b.offsetTop+"; z-index:"+b.zIndex+'"><div class="member_info border_'+b.blackLinePos+'" style="left:'+b.infoPosX+"; top:"+b.infoPosY+"; width:"+b.infoWidth+"; height:"+b.infoHeight+"; text-align:"+b.textAlign+'">',c+='<div class="plus_sign '+b.plusPos+'"></div>',c+="<h2>"+b.name+"</h2>",c+="<h3>"+b.title+"</h3>",c+='<p class="short_bio">'+b.shortBio+"</p></div>",c+='<img src="images/team/'+b.bigPhoto+'" alt="'+b.name+'" />',c+="</li>",k.push("images/team/"+b.bigPhoto),f+=0===a?'<li class="active">':"<li>",f+="<h2>"+b.name+"</h2>",f+="<h3>"+b.title+"</h3>",f+="</li>",g+=0===a?'<div class="tab active">':'<div class="tab">',g+='<header class="member_header clearfix">',g+='<img src="images/team/'+b.smallPhoto+'" alt="'+b.name+'" />',g+="<h2>"+b.name+"</h2>",g+="<h3>"+b.title+"</h3>",g+='</header><div class="member_long_bio">',g+=b.longBio,g+="</div></div>"}),a("#team_container").html("<ul>"+c+"</ul>"),preloadimages(k,function(a){i(),d(),e(),j()}),h.find(".tabs_nav").html(f),h.find(".tabs_content").html(g),h.show()}),a("#team").on("click",".member",function(){var b=a(this).data("index");a("#team_popup").find(".tabs_nav li").eq(b).trigger("click")}),a("#hiring").on("click",".jobs_list li",function(){var b=a(this).data("index");a("#jobs_popup").find(".tabs_nav li").eq(b).trigger("click")}),a.getJSON("/images/data/jobs.json",function(b){var c='<ul class="jobs_list">',d="",e="",f=a("#jobs_popup");a.each(b,function(a,f){b.length>0&&((a+1)%6===0&&(c+='</ul><ul class="jobs_list">'),c+='<li data-popup="jobs_popup" data-index="'+a+'">',c+="<h3>"+f.jobTitle+"</h3>",d+=0===a?'<li class="active">':"<li>",d+="<h2>"+f.jobTitle+"</h2>",d+="</li>",e+=0===a?'<div class="tab active">':'<div class="tab">',e+='<header class="job_header clearfix">',e+="<h2>"+f.jobTitle+"</h2>",e+='<a class="button small" href="mailto:jobs@wondermall.com?subject=I want to be a '+encodeURIComponent(f.jobTitle)+' in Wondermall&body=(please attach your CV)">Apply</a>',e+='</header><div class="jobs_desc">',e+=f.jobDescription,e+="</div></div>")}),c+="</ul>",0===b.length&&(c='<a class="button" href="mailto:jobs@wondermall.com?subject=I want to join Wondermall&body=(please attach your CV)">Apply to join us</a>'),a("#jobs_list").html(c),f.find(".tabs_nav").html(d),f.find(".tabs_content").html(e)}),a("#join").on("click",".jobs_list li",function(){var b=a(this).data("index");jobsPopup.find(".tabs_nav li").eq(b).trigger("click")}),a.getJSON("/images/data/investors.json",function(b){var c="";a.each(b,function(a,b){c+='<li class="investor">',c+='<img src="images/investors/'+b.photo+'" alt="'+b.name+'" />',c+="<h3>"+b.name+"</h3>",c+=b.description,c+="</li>"}),a("#investors_container").html(c)});var v=a.superscrollorama({triggerAtCenter:!1,isVertical:!1,reverse:!0});document.location.hash.length>0&&window.setTimeout(function(){a('a[href="'+document.location.hash+'"]').click()},1e3),window.openWindowedTab=function(a,b,c,d){var e=screen.width/2-c/2,f=screen.height/2-d/2;return window.open(a,b,"toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width="+c+", height="+d+", top="+f+", left="+e)}});

$(document).ready(function(){
	handleProjector();
	handleTriangleHeight();
	handleFlyingPaper();
})

function handleProjector() {
	if($('.projector').length) {
		var posX, posY, projectorX, projectorY
		var halfWidth =  $('.projector').width() / 2
		var halfHeight =  $('.projector').height() / 2

		$(window).on('mousemove', function(e) {
			posX = e.clientX;
    		posY = e.clientY;

    		if(posY < ($(window).height() - halfHeight)) {
    			projectorX = posX - halfWidth 
    			projectorY = posY - halfHeight 

    			$('.projector').css('left', projectorX)
    			$('.projector').css('top', projectorY)
    		}
		})
	}
}

function handleTriangleHeight() {
	$(window).on('resize', function(e) {
		// somehow resize :after here
	})
}

function handleFlyingPaper() {
	$(window).on('mousewheel', function(e) {
		alert()
		if($('#personalized-education').offset().left <= 0) {
			e.preventDefault();
			e.stopPropagation();
			console.log($('#personalized-education').offset().left)
		}
	})
}

jQuery(".btn-learn-more").click(function () {
    if (!jQuery(".txt-lear-more").hasClass('active')) {
        jQuery(".txt-lear-more").addClass("active");
    }
})
jQuery(".close-popup").click(function () {
    if (jQuery(".txt-lear-more").hasClass('active')) {
        jQuery(".txt-lear-more").removeClass("active");
    }
})

