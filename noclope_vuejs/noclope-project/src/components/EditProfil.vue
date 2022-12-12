<script>
export default{
  
  data(){
    return{
      contacts:[],
      firstname:"",
      lastname:"",
      number_phone:"",
      feedbackMessage:""
    };
  },

  methods: {
    async getContacts(){
      const response = await fetch("http://127.0.0.1:8000/api/contact", {
        method:"GET",
        headers:{
          "Accept":"application/json"
        }
      });

      const data = await response.json();
     
      this.contacts = data.contacts;
    },

    async createContact(){
        const body = {
            number_phone: this.number_phone,    
            firstname: this.firstname,
            lastname: this.lastname,

        }
        const response = await fetch("http://127.0.0.1:8000/api/contact",{
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify(body)
        });

        const data = await response.json();

        this.feedbackMessage = data.message;
        this.getContacts();
    }
  },
  mounted(){
    this.getContacts();
  }
};
</script>