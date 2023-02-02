export default class CustomerService {


    getCustomersLarge() {
        return fetch('http://127.0.0.1:8000/demo/data/customers-large.json').then(res => res.json())
                .then(d => d.data);
    }
    getCustomers(params) {
        const queryParams = params ? Object.keys(params).map(k => encodeURIComponent(k) + '=' + encodeURIComponent(params[k])).join('&') : '';
        return fetch('https://www.primefaces.org/data/customers?' + queryParams).then(res => res.json())
    }
 }