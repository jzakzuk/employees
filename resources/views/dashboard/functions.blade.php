<script>
    function loadContent( args ){
      let url = args.link;
      let target = undefined == args.target ? 'main_content_target' : args.target;
      let dashboardTitle = args.dashboard_title;
      fetch(url).then(response=> response.text()).then((text)=> {
        document.getElementById('dashboard-option-title').innerHTML = dashboardTitle;
        document.getElementById(target).innerHTML = text;
        alterarPaginacion({dashboard_title:dashboardTitle});
        if( undefined != args.callback && typeof args.callback == 'function' ) args.callback();
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
      frm = Object.fromEntries(frm);

      removeError();

      axios.post(url, frm).then(response => {
        
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



    function alterarPaginacion( args ){
        var elements = document.getElementsByClassName("page-link");
        let myFunction = () => {
            if( undefined != event ){
                event.preventDefault();
                let element = event.target;
                let hr = element.href;
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
        loadContent({
                    link: url + '?search=' + text,
                    dashboard_title: 'Personal',
        });
   }



  </script>