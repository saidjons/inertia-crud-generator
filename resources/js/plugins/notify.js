
    import AWN from "awesome-notifications"

export default function notify(message,status ='success'){
    
    //    let globalOptions =  {
    //             position:'top-right',
    //             icons:{
    //                 enabled:true,
    //             },
    //             durations: {status: 0}
    //             }
    //     let notifier = new AWN(globalOptions)
    if (status =='success') {
        new AWN()[status](message, {durations: {success: 0}})
        
    } else if(status =='warning'){
        new AWN()[status](message, {durations: {warning: 0}})
        
    }else{
        new AWN().tip(message, {durations: {tip: 0}})

    }

        // let nextCallOptions = {}
      
        // notifier[status](message)

}  