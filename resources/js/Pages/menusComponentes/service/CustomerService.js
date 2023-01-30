export default class CustomerService {

 // decir hola
 getCustomersLarge() { // getCustomersLarge(...).then is not a function por que no es una promesa
        // hacerlo con promesa
        return new Promise((resolve, reject) => {
            fetch('DATOS.json')
                .then(res => res.json())
                .then(data => resolve(data))
                .catch(err => reject(err));
        }
        );
    }


 }