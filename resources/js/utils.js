import localForage from "localforage";
import AWN from "awesome-notifications";

// Set global options
let globalOptions =  {
    position: "top-right",
    labels: {
        tip: "tip",
        info: "info",
        success: "success",
        warning: "attention",
        alert: "error",
        async: "loading",
        confirm: "Confirmation required",
        confirmOk: "OK",
        confirmCancel: "cancel",
    },
    icons: {
        tip: "question-circle",
        info: "info-circle",
        success: "check-circle",
        warning: "exclamation-circle",
        alert: "exclamation-triangle",
        async: "cog fa-spin",
        confirm: "exclamation-triangle",
        prefix: "<i class='fa fas fa-fw fa-",
        suffix: "'></i>",
        enabled: true,
    },
}

// Initialize instance of AWN
let notifier = new AWN(globalOptions)
window.notyf = notifier;

window.localForage = localForage;

/* Set item in localForage */
window.saveStorage = function(name, data){
    localForage.setItem(name, data).then((value) => {
        return true;
    }).catch((err) => {
        console.log(err);
        return false;
    });
};

/* Set item in local Storage - OFFLINE Support*/
window.saveOfflineStorage = function(type, record, model, data){
    // simple parser, get form data as object
    const entry = {
        time: new Date().getTime(),
        type: type,
        record: record,
        model: model,
        data: data
    }
    localStorage.setItem('to_sync_'+entry.time, JSON.stringify(entry));
};
