const nl2br = (str) => {
    var res = str.replace(/\r\n/g, "<br>");
    res = res.replace(/(\n|\r)/g, "<br>");
    return res;
}
// exportを指定すると外でこの関数を使用できるようになる
export { nl2br }
