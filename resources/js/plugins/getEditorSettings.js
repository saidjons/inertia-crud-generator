
export default function getEditorSettings(type){
  let menu = {
          "theme":"tailwind",
            "format": "grid",
        schema: {
    'title': 'admin',
    'type': 'object',
    'required': [
      'title',
       
      'published'
    
    ],
    'properties': {
      'title': {
        'type': 'string',
        
        'minLength': 4
         
      },
      'link': {
        'type': 'string',
        
        'minLength': 4
         
      },
      
      
      'nested': {
        'type': 'string',
        'enum': [
          'true',
          'false'
        ],
        'default': 'false'
      },
      'subs': {
        'type': 'array',
        'format': 'table',
        'title': 'Sub Menus',
        'uniqueItems': true,
        'items': {
          'type': 'object',
          'title': 'sub menu',
          'properties': {
            'title': {
              'type': 'string',
              'enum': [
                'Create',
                'Edit',
                'List',
                'View',
                'Other'
              ],
              'default': 'Create'
            },
            'link': {
              'type': 'string',
              'default':'/admin/'
            }
          }
        },
        
      },
        'published': {
        'type': 'string',
        'enum': [
          'true',
          'false'
           
        ],
        'default': 'true'

      },
    }
  }
}
      let dropdown = {
          "theme":"bootstrap4",
          "iconlib":"spectre",
            "format": "grid",
        schema: {
          type: "object",
          title: " Dropdown",
          properties: {
            useDefaultOptions:{
              type:"boolean",
              format:"checkbox",
            },
            questions: {
              title:"questions",
              type: "array",
              items:{
                title:"question",
                properties:{
                question:{
                  type:"string",
                  title:"question",
                  
                  },
                  correctAnswer:{
                    type:"string",
                    title:"correct Answer",
                     
                  },
                  options:{
                    title:"options",
                    type:"array",

                    items:{
                      title:"option",
                      type:"string"
                    },
                       "options": {
                    "dependencies": {
                      "useDefaultOptions": "false"
                      }
                    }
                  },
                }
              }
            },
            options: {
              type: "array",
              items:{
                title:" general options",
                type:"string",

                  "options":{
                    "inputAttributes":{
                      "placeholder":"bu nima [:2]"
                    }
                  }
              },
            },
          }
        }
      }
      let matchToleft = {
          "theme":"bootstrap4",
          "iconlib":"spectre",
        schema: {
          type: "object",
          title: " Match To Left",
          properties: {
            useDefaultOptions:{
              type:"boolean",
              format:"checkbox"

            },
            questions: {
              title:"Leftside",
              type: "array",
              items:{
                title:"question",
                properties:{
                 
                question:{
                  type:"string",
                  title:"left part",
                  
                  },
                  correctAnswer:{
                    type:"string",
                    title:"Correct right part"
                  }

                }
              }
            },
            options: {
              type: "array",
              items:{
                title:"right side",
                type:"string",

              }
            },
          }
        }
      }
       switch (type) {
         
         case 'menu':
           return menu;
           break;
         
          case 'dropdown':
          return dropdown;
          break;

          case 'matchToleft':
          return matchToleft;
          break;
         
         default:
           break;
       }
}  