var VerifyString = {
    verifyMessage: function(message) {
        return !(message.length < 2 || message.length > 2048);
    },
    verifyFieldNotBlank: function(field) {
        return field.trim() !== '';
    }
};

module.exports = VerifyString;