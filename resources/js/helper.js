export default {
    cutLength(data, L){
        return  data.length > L ? data.substring(0, L-1) + "..." : data;
    },
    getOptionTableHeader(a) {
        let header = [];
        for (let i = 0; i < a.length; i++) {
            header.push({text: a[i]});
        }
        return header;
    },
    deleteFromRepository(data, repository) {
        for (let i = 0; i < repository.length; i++) {
            if (repository[i].id === data) {
                repository.splice(i, 1)
            }
        }
    },
    information_modal(source, data, parameter) {
        console.log(source)
        let val = {...data};
        for (let i in parameter) {
            delete val[parameter[i]];
        }
        source.push(val);
    },
    async mydelete(address, data) {
        let result;
        // console.log(data)
        await axios.post(address, data).then(res => {
            result = res.data;
        })

        return result
    },

    async update(address, data) {
        let result;
        await axios.post(address, data).then(res => {
            result = res.data;
        }).catch(e => {
            console.log(e)
        })
        return result;
    },

    async store(address, data) {
        let result;
        await axios.post(address, data).then(res => {
            result = res.data;
        }).catch(e => {
            console.log(e)
        })
        return result;
    },

}
