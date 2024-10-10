// eventBus.ts
import mitt from 'mitt';

// Define the event types you expect
type Events = {
  loadPayments: string;
};

// Create a typed emitter
const emitter = mitt<Events>();

export default emitter;
