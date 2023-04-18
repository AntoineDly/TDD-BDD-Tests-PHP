window.login = (form) => {
    const formData = new FormData(form);
    const username = formData.get('username');
    if (verifyFieldNotBlank(username)) {
        fetch('login.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(data => console.log(data))
            .catch(error => console.error(error));

        return true;
    } else {
        alert('Veuillez saisir votre nom.');
        return false;
    }
}

window.register = (form) => {
    const formData = new FormData(form);
    const username = formData.get('username');
    if (verifyFieldNotBlank(username)) {
        fetch('register.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(data => console.log(data))
            .catch(error => console.error(error));

        return true;
    } else {
        alert('Veuillez saisir votre nom.');
        return false;
    }
}

window.createChannel = (form) => {
    const formData = new FormData(form);
    const name = formData.get('name');
    if (verifyFieldNotBlank(name)) {
        fetch('createChannel.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(data => console.log(data))
            .catch(error => console.error(error));

        return true;
    } else {
        alert('Veuillez saisir un nom correct de salon');
        return false;
    }
}

window.selectChannel = (form) => {
    const formData = new FormData(form);

    fetch('selectChannel.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(data => console.log(data))
        .catch(error => console.error(error));

    return true;
}

window.sendMessage = (form) => {
    const formData = new FormData(form);
    const message = formData.get('message');
    if (verifyMessage(message)) {
        fetch('sendMessage.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(data => console.log('data' + data))
            .catch(error => console.error('error' + error));
        return true;
    } else {
        alert('Veuillez renseigner une taille correcte de message (entre 2 et 2048 caractères)');
        return false;
    }
}

window.changeChannel = () => {
    fetch('changeChannel.php', {})
        .then(response => response.text())
        .then(data => console.log(data))
        .catch(error => console.error(error));

    return true;
}

window.disconnect = () => {
    fetch('disconnect.php', {
    })
        .then(response => response.text())
        .then(data => console.log(data))
        .catch(error => console.error(error));

    return true;
}

const verifyMessage = (message) => {
    return !(message.length < 2 || message.length > 2048);
}
const verifyFieldNotBlank = (field) => {
    return field.trim() !== '';
}