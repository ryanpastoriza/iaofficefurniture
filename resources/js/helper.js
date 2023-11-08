const myPlugin = {
    install(app) {
        app.config.globalProperties.numFormat = (key) => {
        	const options = { 
			  minimumFractionDigits: 2,
			  maximumFractionDigits: 2 
			};
            return parseFloat(key).toLocaleString('en', options);
        },
        app.config.globalProperties.baseUrl = (key) => {
           return window.location.origin + '/';
        },
        app.config.globalProperties.titleCase = (str) => {

            if( str == null || str.length == 0 ){
                return '';
            }

            return str.toLowerCase().split(' ').map(function (word) {
                return (word.charAt(0).toUpperCase() + word.slice(1));
            }).join(' ');    
          
        }
    }
}
 
export default myPlugin;