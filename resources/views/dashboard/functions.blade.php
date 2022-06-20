<script>
    function loadContent( args ){
      let url = args.link;
      let target = undefined == args.target ? 'main_content_target' : args.target;
      let dashboardTitle = args.dashboard_title;
      fetch(url).then(response=> response.text()).then((text)=> {
        if( undefined != dashboardTitle )document.getElementById('dashboard-option-title').innerHTML = dashboardTitle;
        document.getElementById(target).innerHTML = text;
        alterarPaginacion({dashboard_title:dashboardTitle});
        if( undefined == args.callback ) return;
        console.log('---there is a callback----');
        console.log( args.callback );
        if( typeof args.callback != 'function' && typeof args.callback != 'object' ) return;
        console.log('---passed 1--');
        if( typeof args.callback == 'function' ) args.callback();
        console.log('---passed 2--');
        if( undefined == args.callback.fn ) return;
        console.log('---passed 3--');
        window[args.callback.fn]( args.callback.args || null );
      });
    }
    function successT(text){
        toast(text, 'green');
    }
    function errorT(text){
        toast(text, 'red');
    }
    function removeError(){
        Array.from(document.getElementsByClassName('error-span')).forEach(box => { box.remove(); });
    }
    function toast(text, bgcolor){
        Toastify({
            text:text,
            duration: 3000,
            newWindow: false,
            close: true,
            gravity: "bottom", // `top` or `bottom`
            position: "right", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
            background: bgcolor,
            },
        }).showToast();
    }
    function submitForm( formElement ){

      event.preventDefault();
      let url = formElement.action;
      let frm = Array.from(new FormData(formElement));

      let form = {};

      frm.forEach( itm => {
        if( itm[0].includes('[]') ){
            let key = itm[0].replace('[]', '');
            if( undefined == form[key] ) form[key] = [];
            form[key].push(itm[1]);
        }else{
            form[itm[0]] = itm[1];
        }
      } );

     
      console.log( form );
      frm = Object.fromEntries(frm);

      //console.log(frm);

      removeError();

      axios.post(url, form).then(response => {
        
        successT( response.data.message );

        if( undefined != response.data.goto ){
            loadContent({
                link:response.data.goto,
                dashboard_title:'Detalles de: ' + response.data.user.name
            });
        }

      }).catch( err => {

        Object.keys(frm).forEach(item => {

            if( item == '_token' ) return;
            if( undefined == err.response ) return;
            if( undefined == err.response.data ) return;
            if( undefined == err.response.data.errors ) return;
            if( undefined == err.response.data.errors[item] ) return;
            let text = err.response.data.errors[item];
            let element = document.getElementsByName( item )[0];
            let span = document.createElement('span');
            span.innerHTML = text;
            span.classList.add('error-span');
            span.classList.add('text-danger');
            element.parentNode.appendChild( span );

        });

        errorT('Ha ocurrido un error al enviar el formulario');
      });
    }
    
    function startSearch(element){
        let target = element.dataset.list;
        document.getElementById(target).style.display = "block";
    }

    function stopSearch(element){
        setTimeout(() => {
            let target = element.dataset.list;
            document.getElementById(target).style.display = "none";
        }, 100);
    }

    function searchData(element){
        let url = element.dataset.url;
        let target = element.dataset.list;
        let id_el =  document.getElementById(element.dataset.id);


        axios.get( url+'/'+element.value ).then(response => {
            if( response.data == '' ){
                id_el.value = '';
            }
            document.getElementById(target).innerHTML = response.data;
        }).catch(err => {
            alert('errrorrrr');
        });
    }

    function deleteUser(urlDelete, urlIndex){
        axios.post(urlDelete).then(response => {
            successT( response.data.message );
            loadContent({
                link:urlIndex,
                dashboard_title:'Personal'
            });
        }).catch(err => {
            errorT('Ha ocurrido un error al eliminar el usuario');
        });
    }

    function alterarPaginacion( args ){
        var elements = document.getElementsByClassName("page-link");
        let myFunction = () => {
            if( undefined != event ){
                event.preventDefault();
                let element = event.target;
                let hr = element.href;
                if( undefined == hr ) return;
                loadContent({
                    link: hr,
                    dashboard_title: args.dashboard_title,
                });
            }
        };
        for (let i = 0; i < elements.length; i++) {
            elements[i].addEventListener('click', myFunction, false);
        }
    }


   function searchIndex(element, url){
        if( event.key != 'Enter' ) return;
        let text = element.value;
        let target = element.dataset.target;
        loadContent({
                    link: url + '?search=' + text,
                    dashboard_title: 'Personal',
                    target:target
        });
   }

   function checkRole(id, role){
    console.log('--id--: ' + id);
    console.log('--role--: ' + role);
        if( role != 'presidente' ) return;
        console.log('--passed 1--');
        let chk =  document.getElementById(id).checked;
        const inputs = document.querySelectorAll('input.not_president');
        inputs.forEach(input => {
            input.disabled = chk;
            if( !chk ) input.checked = false;
        });
        let boss_select = document.getElementById('user_id');
        if( chk ){
            boss_select.value = '';
            boss_select.disabled = true;
        }else{
            boss_select.disabled = false;
        }
   }

  </script>