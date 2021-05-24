import { deburr, isEmpty } from 'lodash';
export const sanitize = deburr;
export const sanitizeAndLower = value => sanitize(value).toLowerCase();
export const contains = (st, value) => sanitizeAndLower(st).indexOf(sanitizeAndLower(value)) > -1;
