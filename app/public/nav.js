function setActiveNav() {
    switch (window.location.pathname) {
        case '/home':
            document.getElementById('homeNav').className += ' text-danger';
            break;

        case '/mgames':
            document.getElementById('mgamesNav').className += ' text-danger';
            break;
        
        case '/sgames':
            document.getElementById('sgamesNav').className += ' text-danger';
    }
}