import { config } from '@vue/test-utils';
import { createVuetify } from 'vuetify';
import '@testing-library/jest-dom';
import 'vuetify/styles';

// Create a Vuetify instance
const vuetify = createVuetify();

// Mock global properties (if needed)
config.global.plugins = [vuetify];