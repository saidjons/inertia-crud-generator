export default function getEditorSettings(type) {
  let optionField = {
    theme: "tailwind",
    format: "grid",
    schema: {
      title: "Person",
      type: "object",
      properties: {
        values: {
          title: "Options",
          type: "array",
          items: {
            type: "string",
          },
        },
        isWithKeys: {
          type: "boolean",
          format: "checkbox",
          default: "false",
        },
        keyValues: {
          type: "array",
          format: "table",
          title: "Key value pair",
          uniqueItems: true,
          items: {
            type: "object",
            title: "  Key Value",
            properties: {
              key: {
                type: "string",
              },
              value: {
                type: "string",
              },
            },
          },
        },
      },
    },
  };

  let menu = {
    theme: "tailwind",
    format: "grid",
    schema: {
      title: "admin",
      type: "object",
      required: ["title", "published"],
      properties: {
        title: {
          type: "string",

          minLength: 4,
        },
        link: {
          type: "string",

          minLength: 4,
        },

        nested: {
          type: "boolean",
          format: "checkbox",
          default: "false",
        },
        subs: {
          type: "array",
          format: "table",
          title: "Sub Menus",
          uniqueItems: true,
          items: {
            type: "object",
            title: "sub menu",
            properties: {
              title: {
                type: "string",
                format:"input",
                default: "Create",
              },
              link: {
                type: "string",
                default: "/admin/",
              },
             
              target_blank: {
                type: "boolean",
                format: "radio",
                default: "false",
                options: {
                  "inputAttributes": {
                    "class": "p-2 m-2 bg-gray-200 text-gray-700 border-gray-20"
                  },
                }
              },
            },
          },
        },
        published: {
          type: "boolean",
          format: "checkbox",
          default: "false",
        },
      },
    },
  };
  let dropdown = {
    theme: "tailwind",
    format: "grid",
    schema: {
      type: "object",
      title: " Dropdown",
      properties: {
        useDefaultOptions: {
          type: "boolean",
          format: "checkbox",
        },
        questions: {
          title: "questions",
          type: "array",
          items: {
            title: "question",
            properties: {
              question: {
                type: "string",
                title: "question",
              },
              correctAnswer: {
                type: "string",
                title: "correct Answer",
              },
              options: {
                title: "options",
                type: "array",

                items: {
                  title: "option",
                  type: "string",
                },
                options: {
                  dependencies: {
                    useDefaultOptions: "false",
                  },
                },
              },
            },
          },
        },
        options: {
          type: "array",
          items: {
            title: " general options",
            type: "string",

            options: {
              inputAttributes: {
                placeholder: "bu nima [:2]",
              },
            },
          },
        },
      },
    },
  };
  let matchToleft = {
    theme: "tailwind",
    schema: {
      type: "object",
      title: " Match To Left",
      properties: {
        useDefaultOptions: {
          type: "boolean",
          format: "checkbox",
        },
        questions: {
          title: "Leftside",
          type: "array",
          items: {
            title: "question",
            properties: {
              question: {
                type: "string",
                title: "left part",
              },
              correctAnswer: {
                type: "string",
                title: "Correct right part",
              },
            },
          },
        },
        options: {
          type: "array",
          items: {
            title: "right side",
            type: "string",
          },
        },
      },
    },
  };
  switch (type) {
    case "menu":
      return menu;

    case "dropdown":
      return dropdown;

    case "matchToleft":
      return matchToleft;
    case "optionField":
      return optionField;

    default:
      break;
  }
}
