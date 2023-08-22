
export default {
    formatMoney1(value, currency, code = true) {
        if (!currency) {
            return value;
        }
        const amount = Number(value)
            .toFixed(currency.decimal_place)
            .replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");

        return code ? `${currency.code} ${amount}` : amount;
    },

    formatMoney(value) {
        return Number(value)
            .toFixed(2)
            .replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
    },

    formatMoneyNOD(value) {
        return Number(value)
            .toFixed(0)
            .replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
    },

    formatDate(value) {
        if (value) {
            return moment(String(value)).format('DD-MM-YYYY');
        }
    },

    formatDateTime(value) {
        if (value) {
            return moment(String(value)).format('DD-MM-YYYY hh:mm A');
        }
    },

    titleCase(value) {
        const testString = value;

        const titleCaseString = testString
            .replace(/(_|-)/g, ' ')
            .trim()
            .replace(/\w\S*/g, function(str) {
                return str.charAt(0).toUpperCase() + str.substr(1);
            })
            .replace(/([a-z])([A-Z])/g, '$1 $2')
            .replace(/([A-Z])([A-Z][a-z])/g, '$1 $2');

        return titleCaseString;
    },

    trim(value, max) {
        if (!value) {
            return value;
        }
        const len = value.length;
        return len > max ? `${value.substring(0, max)}...` : value;
    }
};
