const nl2br = (str) => {
    var res = str.replace(/\r\n/g, "<br>");
    res = res.replace(/(\n|\r)/g, "<br>");
    return res;
}
// exportを指定すると外でこの関数を使用できるようになる
export { nl2br }

const getToday = () => {
    const today = new Date();
    const yyyy = today.getFullYear();
    const mm = ("0"+(today.getMonth()+1)).slice(-2);
    const dd = ("0"+today.getDate()).slice(-2);
    return yyyy + '-' + mm + '-' + dd;
}
export { getToday }
