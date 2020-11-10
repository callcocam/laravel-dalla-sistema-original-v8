import { filter } from 'lodash';
import { contains } from './strings';

export const makeFilterByProp = key => (list, st) => filter(list, row => contains(row[key], st));
export default (key, list, st) => filter(list, row => contains(row[key], st));
